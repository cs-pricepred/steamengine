import * as d3 from "d3";
import { timeMonths } from "d3";

document.addEventListener("DOMContentLoaded", function () {
    if (saleHistory == "undefined") return;

    saleHistory = saleHistory.map((s) => {
        s.time = new Date(s.time);
        return s;
    });

    const el = document.querySelector("#salegraph");
    console.debug(el);
    const width = el ? el.getBoundingClientRect().width : 900;
    const height = 300;
    const margin = 20;

    const svg = d3
        .select("#salegraph")
        .append("svg")
        .attr("width", width)
        .attr("height", height)
        .append("g");

    console.debug(saleHistory);
    const x = d3.scaleTime(
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
        .call(d3.axisBottom(x).ticks(d3.timeMonth.every(6)).tickSizeOuter(0));

    // Add the y-axis, remove the domain line, add grid lines and a label.
    svg.append("g")
        .attr("transform", `translate(${width - margin},0)`)
        .call(d3.axisRight(y).ticks(height / 60))
        .call((g) =>
            g
                .append("text")
                .attr("x", -margin * 1.3)
                .attr("y", 10)
                .attr("fill", "currentColor")
                .attr("text-anchor", "start")
                .text("↑ Price (€)")
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
        .attr("fill", "transparent")
        .style("stroke", "currentColor")
        //.attr("opacity", 0.7)
        .style("pointer-events", "none");

    // create tooltip div

    const tooltip = d3
        .select("body")
        .append("div")
        .attr("class", "tooltip")
        .attr(
            "style",
            "position: absolute; padding: 5px; background-color: rgb(11, 40, 65); color: white; border: 0px solid white; border-radius: 0px; display: none; opacity: .75; font-size: 14px;"
        );

    // Create a second tooltip div for raw date

    const tooltipRawDate = d3
        .select("body")
        .append("div")
        .attr("class", "tooltip")
        .attr(
            "style",
            "position: absolute; padding: 5px; background-color: rgb(11, 40, 65); color: white; border: 0px solid white; border-radius: 0px; display: none; opacity: .75; font-size: 14px;"
        );

    // Add red lines extending from the circle to the date and value

    const tooltipLineX = svg
        .append("line")
        .attr("class", "tooltip-line")
        .attr("id", "tooltip-line-x")
        .attr("stroke", "currentColor")
        .attr("stroke-width", 1)
        .attr("stroke-dasharray", "2,2");

    const tooltipLineY = svg
        .append("line")
        .attr("class", "tooltip-line")
        .attr("id", "tooltip-line-y")
        .attr("stroke", "currentColor")
        .attr("stroke-width", 1)
        .attr("stroke-dasharray", "2,2");

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

        // Update the position of the red lines

        tooltipLineX
            .style("display", "block")
            .attr("x1", xPos)
            .attr("x2", xPos)
            .attr("y1", 0)
            .attr("y2", height);
        tooltipLineY
            .style("display", "block")
            .attr("y1", yPos)
            .attr("y2", yPos)
            .attr("x1", 0)
            .attr("x2", width);

        // add in our tooltip

        tooltip
            .style("display", "block")
            .style("left", `${width + 90}px`)
            .style("top", `${yPos + 68}px`)
            .html(`${d.price !== undefined ? d.price.toFixed(2) : "N/A"}€`);

        tooltipRawDate
            .style("display", "block")
            .style("left", `${xPos + 60}px`)
            .style("top", `${height + 53}px`)
            .html(
                `${d.time !== undefined ? d.time.toLocaleDateString() : "N/A"}`
            );
    });

    // listening rectangle mouse leave function

    listeningRect.on("mouseleave", function () {
        circle.transition().duration(50).attr("r", 0);
        //tooltip.style("display", "none");
        tooltipRawDate.style("display", "none");
        tooltipLineX.attr("x1", 0).attr("x2", 0);
        tooltipLineY.attr("y1", 0).attr("y2", 0);
        tooltipLineX.style("display", "none");
        tooltipLineY.style("display", "none");
    });
});
