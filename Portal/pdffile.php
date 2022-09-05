
<!DOCTYPE html>
<html>
  <body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <p id="ignorePDF">don't print this to pdf</p>
    <div>
      <p><font size="3" color="red">print this to pdf</font></p>
    </div>
    <button onclick="createPdf()">Click me</button>
  </body>
</html>


<script>
function createPdf(){
    var doc = new jsPDF();          
    var elementHandler = {
    '#ignorePDF': function (element, renderer) {
        return true;
    }
    };
    var source = window.document.getElementsByTagName("body")[0];
    doc.fromHTML(
        source,
        15,
        15,
        {
        'width': 180,'elementHandlers': elementHandler
        });

    doc.output("dataurlnewwindow");
    doc.save('sample-document.pdf');}
</script>
