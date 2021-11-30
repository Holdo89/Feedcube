function createPdf(div){
    html2canvas(document.getElementById(div),{
        scale:3,
        onrendered: function(canvas){
            var img = canvas.toDataURL("image/png");
            var doc = new jsPDF();
            doc.addImage(img, 'JPEG',0,0,200,140);
            doc.save('sample-document.pdf');
        }});}
