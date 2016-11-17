<div class="col-xs-12 t-center">

    <div class="homepage">
        <div class="text">
            Ayez les bons réflexes pour bien démarrer votre entreprise.
        </div>
    </div>
    
    <!--<h1 class="col-xs-12"> Page d'accueil </h1>-->

    <!--<div class="col-xs-12 t-center mt40">
        <h2> Liste des catégories</h2>
    </div>-->
    <!--<div class="col-xs-12 mt40">
        <table class="billets-by-categorie-table col-xs-12">
            <tr>
                <th class="t-center">
                    Label
                </th>
                <th class="t-center">
                    Nombre de billets
                </th>
                <th>
                    Action
                </th>
            </tr>
            <?php foreach ($categoriesWithBillets as $category): ?>
                <tr>
                    <td class="t-center">
                        <?php echo $category['label'] ?>
                    </td>
                    <td class="t-center">
                        <?php echo $category['billets_count'] ?>
                    </td>
                    <td>
                        <a href="<?php echo $app->urlFor('billets_by_category', array('id' => $category['id'], 'page' => 1)) ?>"> Voir </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>-->
    <!--<div class="col-xs-12 mt40">
        <h2> Répartition des posts par catégorie </h2>
        <div id="myPieChart"/>
    </div>-->
</div>

<!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // Define the chart to be drawn.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Element');
        data.addColumn('number', 'Percentage');

        data.addRows(<?php //echo json_encode($billetsByCategory) ?>);

        // Instantiate and draw the chart.
        var chart = new google.visualization.PieChart(document.getElementById('myPieChart'));
        chart.draw(data, null);
    }

</script>-->

