import "./bootstrap";
import * as d3 from "d3";

// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();
//

document.addEventListener("DOMContentLoaded", function () {
    console.log("loaded");

    const width = 900;
    const height = 300;
    const margin = 20;

    const svg = d3
        .select("#salegraph")
        .append("svg")
        .attr("width", width)
        .attr("height", height)
        .append("g");

    console.log(saleHistory);
    const x = d3.scaleUtc(
        d3.extent(saleHistory, (s) => s.time),
        [0, width - margin]
    );

    // Declare the y (vertical position) scale.
    const y = d3.scaleLinear(
        [0, d3.max(saleHistory, (s) => s.price)],
        [height - margin, margin]
    );

    // Declare the line generator.
    const line = d3
        .line()
        .x((d) => x(d.time))
        .y((d) => y(d.price));

    const area = d3
        .area()
        .x((d) => x(d.time))
        .y0(y(0))
        .y1((d) => y(d.price));

    // Add the x-axis.
    svg.append("g")
        .attr("transform", `translate(0,${height - margin})`)
        .call(
            d3
                .axisBottom(x)
                .ticks(width / 80)
                .tickSizeOuter(0)
        );

    // Add the y-axis, remove the domain line, add grid lines and a label.
    svg.append("g")
        .attr("transform", `translate(${width - margin},0)`)
        .call(d3.axisRight(y).ticks(height / 40))
        .call((g) => g.select(".domain").remove())
        .call(
            (g) =>
                g
                    .selectAll(".tick line")
                    .clone()
                    .attr("x2", width - margin)
            // .attr("stroke-opacity", 0.1)
        )
        .call((g) =>
            g
                .append("text")
                // .attr("x", -margin)
                .attr("y", 10)
                .attr("fill", "currentColor")
                .attr("text-anchor", "start")
                .text("↑ Price ($)")
        );

    // Create our gradient

    const gradient = svg
        .append("defs")
        .append("linearGradient")
        .attr("id", "gradient")
        .attr("x1", "0%")
        .attr("x2", "0%")
        .attr("y1", "0%")
        .attr("y2", "100%")
        .attr("spreadMethod", "pad");

    gradient
        .append("stop")
        .attr("offset", "0%")
        .attr("stop-color", "#85bb65")
        .attr("stop-opacity", 1);

    gradient
        .append("stop")
        .attr("offset", "100%")
        .attr("stop-color", "#85bb65")
        .attr("stop-opacity", 0);

    // Append a path for the line.
    svg.append("path")
        .attr("stroke", "#85bb65")
        .attr("fill", "none")
        .attr("stroke-width", 1.5)
        .attr("d", line(saleHistory));

    svg.append("path")
        .style("fill", "url(#gradient)")
        .attr("opacity", 0.5)
        .attr("d", area(saleHistory));

    // Add a circle element

    const circle = svg
        .append("circle")
        .attr("r", 0)
        .attr("fill", "red")
        .style("stroke", "white")
        .attr("opacity", 0.7)
        .style("pointer-events", "none");

    // create a listening rectangle

    const listeningRect = svg
        .append("rect")
        .attr(
            "style",
            "pointer-events: all; fill-opacity: 0; stroke-opacity: 0; z-index: 1;"
        )
        .attr("fill", "none")
        .attr("width", width - margin)
        .attr("height", height);

    // create the mouse move function

    listeningRect.on("mousemove", function (event) {
        const [xCoord] = d3.pointer(event, this);
        const bisectDate = d3.bisector((d) => d.time).left;
        const x0 = x.invert(xCoord);
        const i = bisectDate(saleHistory, x0, 1);
        const d0 = saleHistory[i - 1];
        const d1 = saleHistory[i];
        const d = x0 - d0.time > d1.time - x0 ? d1 : d0;
        const xPos = x(d.time);
        const yPos = y(d.price);

        // UpDate the circle position

        circle.attr("cx", xPos).attr("cy", yPos);

        // Add transition for the circle radius

        circle.transition().duration(50).attr("r", 5);
    });

    // listening rectangle mouse leave function

    listeningRect.on("mouseleave", function () {
        circle.transition().duration(50).attr("r", 0);
    });
});
