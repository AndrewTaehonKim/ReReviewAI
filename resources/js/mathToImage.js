import svg2png from "mathjax-node-svg2png";

const math = process.argv[2];

svg2png.typeset(
    {
        math: math,
        format: 'TeX',
        svg: false,
        png: true,
    }, function (buffer, error) {
        if (error) {
            console.error("Error converting SVG to PNG:", error);
          } else {
            process.stdout.write(buffer.png);
          }
    }
);