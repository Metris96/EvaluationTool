<?php
  include "start.php"
 ?>
<script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.3/xlsx.full.min.js">
</script>
<input type="file" id="fileUpload" accept=".xls,.xlsx" /><br />
    <button type="button" id="uploadExcel">Convert</button>
    <pre id="jsonData"></pre>
  </body>
  <script>
    var selectedFile;
    document
      .getElementById("fileUpload")
      .addEventListener("change", function(event) {
        selectedFile = event.target.files[0];
      });
    document
      .getElementById("uploadExcel")
      .addEventListener("click", function() {
        if (selectedFile) {
          console.log("Hi...");
          var fileReader = new FileReader();
          fileReader.onload = function(event) {
            var data = event.target.result;

            var workbook = XLSX.read(data, {
              type: "binary"
            });
            workbook.SheetNames.forEach(sheet => {
              let rowObject = XLSX.utils.sheet_to_row_object_array(
                workbook.Sheets[sheet]
              );
              for (x in rowObject){
                document.getElementById("jsonData").innerHTML += rowObject[x]['Familiar Name'] + " " + rowObject[x]['First Name']+ " " + rowObject[x]['Grp_No'] + " " + rowObject[x]['Grp_Name'] + " " + rowObject[x]['Student_ID'] + " " + rowObject[x]['Class'] + " " + rowObject[x]['E-Mail'] + "\n";
              }
              console.log(JSON.stringify(rowObject));
              //document.getElementById("jsonData").innerHTML = Object.keys(rowObject)

            });
          };
          fileReader.readAsBinaryString(selectedFile);
        }
      });
  </script>
