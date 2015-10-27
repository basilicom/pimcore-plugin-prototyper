<html>
<head>
    <style type="text/css">
        td {
            font-family: monospace;
            background-color: #e0e0e0;
            vertical-align: top;
        }

        tr.row1 td {
            background-color: rgba(90, 193, 255, 0.6);
        }
        tr.row2 td {
            background-color: rgba(255, 253, 73, 0.6);
        }
        label {
            display: inline-block;
            width: 12%;
            vertical-align: top;
        }

        .formline {
            margin-bottom: 4px;
        }
    </style>
</head>
<body>
<h1>Prototyper</h1>
<form method="post">
    <div class="formline"><label for="classname">Object class name</label><input type="text" id="classname" name="classname" value="<?=htmlentities($this->classname)?>"></div>
    <div class="formline"><label for="classname">CSV data incl. header, (NL;)</label><textarea style="height: 160px; width: 87%;" name="csv"><?=htmlentities($this->csvText)?></textarea></div>
    <div class="formline"><label for="preview"></label><input type="submit" name="preview" value="Preview CSV Data"></div>
    <div class="formline">
        <label for="previewTable">Preview parsed data</label>
        <div id="previewTable" style="overflow: scroll;height: 200px; width: auto">
        <?php
        $rowNr = 0;
        echo '<table>';
        foreach ($this->previewTable as $row) {

            $rowNr++;

            echo '  <tr class="row' . $rowNr . '">'."\n";

            foreach ($row as $cell) {

                echo '    <td>';
                echo $cell;
                echo '</td>'."\n";
            }

            echo '  </tr>'."\n";

        }
        echo '</table>';
        ?>
        </div>
    </div>
    <?php if (is_array($this->previewTable) && (count($this->previewTable) > 1)): ?>
    <div class="formline"><label for="preview"></label><input type="submit" name="generate" value="Generate Object Class"></div>
    <?php endif; ?>
</form>

<?=$this->successMessage?>

</body>
