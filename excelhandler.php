<?php
  include "start.php";

 ?>
<script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.3/xlsx.full.min.js">
</script>
<input type="file" id="fileUpload" accept=".xls,.xlsx" /><br />
    <button type="button" id="uploadExcel">Convert</button>
    <form action='addstudents.php' method='POST'>
    <input type="hidden" value="" id="json" name ="json">
    <pre id="jsonData"></pre>
  </form>
  </body>
  <script>
    var selectedFile;
    let array;

    document
      .getElementById("fileUpload")
      .addEventListener("change", function(event) {
        selectedFile = event.target.files[0];
      });
    document.getElementById("uploadExcel").addEventListener("click", function() {
        if (selectedFile) {
          document.getElementById("jsonData").innerHTML = "";
          console.log("Hi...");
          var fileReader = new FileReader();
          fileReader.onload = function(event) {
            var data = event.target.result;

            var workbook = XLSX.read(data, {
              type: "binary"
            });
            workbook.SheetNames.forEach(sheet => {
              var rowObject = XLSX.utils.sheet_to_row_object_array(
                workbook.Sheets[sheet]

              );
              array = rowObject;
              document.getElementById("jsonData").innerHTML = "";
              document.getElementById("json").value =JSON.stringify(array);
              for (x in array){
                document.getElementById("jsonData").innerHTML += array[x]['Familiar Name'] + " " + array[x]['First Name']+ " " + array[x]['Grp_No'] + " " + array[x]['Grp_Name'] + " " + array[x]['Student_ID'] + " " + array[x]['Class'] + " " + array[x]['E-Mail'] + " <input type='button' value='Delete' onclick='Delete( x)'> \n";

              }
              document.getElementById("jsonData").innerHTML += "<input type='submit' name='send' value='send'>";
              //document.getElementById("jsonData").innerHTML = Object.keys(rowObject)
              console.log(document.getElementById('json').value);
            });
          };
          fileReader.readAsBinaryString(selectedFile);
        }
      });
      function Delete(id){
        //document.getElementById("jsonData").innerHTML = array[id]['Familiar Name'];
        delete array[id];
        document.getElementById("json").value =JSON.stringify(array);
        document.getElementById("jsonData").innerHTML = "";
        for (x in array){
          document.getElementById("jsonData").innerHTML += array[x]['Familiar Name'] + " " + array[x]['First Name']+ " " + array[x]['Grp_No'] + " " + array[x]['Grp_Name'] + " " + array[x]['Student_ID'] + " " + array[x]['Class'] + " " + array[x]['E-Mail'] + " <input type='button' value='Delete' onclick='Delete(" + x + ")'> \n";

        }
        document.getElementById("jsonData").innerHTML += "<input type='submit' name='send' value='send'>";
        //console.log(JSON.stringify(array));

      }
  </script>
