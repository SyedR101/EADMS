<!DOCTYPE html>
<!-- Progress bar reference: https://youtu.be/kjhsS4lNZ9o -->
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Testing: Progress Bar</title>
        <style>
            .progress {
                position: relative;
                width: 210px;
                height: 30px;
                background: #9cbab4;
                border-radius: 5px;
                overflow: hidden;
            }

            .progress__fill {
                width: 0%;
                height: 100%;
                background: #009579;
                transition: all 0.2s;
            }

            .progress__text {
                position: absolute;
                top: 50%;
                right: 5px;
                transform: translateY(-50%);
                font: bold 14px "Quicksand", sans-serif;
                color: #ffffff;
            }
        </style>
	</head>

	<body>
    <div class="progress">
        <div class="progress__fill"></div>
        <span class="progress__text">0%</span>
    </div>

    <script>
        function updateProgressBar(progressBar, value) {
            value = Math.round(value);
            progressBar.querySelector(".progress__fill").style.width = `${value}%`;
            progressBar.querySelector(".progress__text").textContent = `${value}%`;
        }

        const myProgressBar = document.querySelector(".progress");

        /* Example */
        updateProgressBar(myProgressBar, 72);
    </script>
	</body>
</html>