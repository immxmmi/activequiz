<html>
<body>
<div>
    <form action="javascript:void(0);">
        <select id="charttype" name="type">
            <option value="none">--- choose a chart ---</option>
            <option value="pie">Pie-Chart</option>
            <option value="bar">Bar-Chart</option>
            <option value="doughnut">Doughnut-Chart</option>
            <option value="unknown">Unknown-Chart</option>
        </select>
    </form>
</div>
<div class="container">
    <div class="chartwrapper">
        <canvas id="apiChart"></canvas>
    </div>
</div>
</body>
</html>