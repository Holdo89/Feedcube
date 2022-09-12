function createPdf(){  
	var opt = {
		html2canvas:  { scale: 2},
		filename:     'externes_feedback.pdf',
		jsPDF:        { unit: 'pt', format: 'a3', orientation: 'portrait' }
	};

	var i=0;
	var source = window.document.getElementsByName("pdf");
	var fullsource = "<div style='width:900px; text-align:center; margin:auto;'>";
	var fullsourceheight = 0;
	var testhtml = "<div> Hallo </div><div>Test Test</div>"

	let worker = html2pdf()
    .set(opt)
    .from(testhtml)
	worker = worker.toPdf(); 

	while(i<source.length-1)
	{
		if(fullsourceheight>1300)
		{
			fullsource=fullsource+"</div><p></p>";
			fullsourceheight =0;
			worker = worker
			.get('pdf')
			.then(pdf => {
			pdf.addPage()
			})
			.from(fullsource)
			.toContainer()
			.toCanvas()
			.toPdf()
			fullsource = "<div style='width:900px; text-align:center; margin:auto;border-top: 1px solid; margin-top:20px'>";
		}
		console.log(source[i].getBoundingClientRect().height)
		fullsource = fullsource + source[i].innerHTML;
		fullsourceheight = fullsourceheight + source[i].getBoundingClientRect().height;
		i=i+1;
	}
    worker.save();}

    function createPdfeinzeln(x){  
        var opt = {
            html2canvas:  { scale: 2},
            filename:     'externes_feedback.pdf',
            jsPDF:        { unit: 'pt', format: 'a3', orientation: 'portrait' }
        };
    
        var i=0;
        var source = document.getElementById("feedback_"+x).querySelectorAll('[name=pdf]');
        var fullsource = "<div style='width:900px; text-align:center; margin:auto;'>";
        var fullsourceheight = 0;
        var testhtml = "<div> Hallo </div><div>Test Test</div>"
    
        let worker = html2pdf()
        .set(opt)
        .from(testhtml)
        worker = worker.toPdf(); 
        var pagenumber = 1;

        while(i<source.length-1)
        {
            if(fullsourceheight>1300)
            {
                fullsource=fullsource+"</div><p></p>";
                fullsourceheight =0;
                worker = worker
                .get('pdf')
                .then(pdf => {
                pdf.addPage()
                })
                .from(fullsource)
                .toContainer()
                .toCanvas()
                .toPdf()
                fullsource = "<div style='width:900px; text-align:center; margin:auto;border-top: 1px solid; margin-top:20px'>";
                pagenumber = pagenumber+1;
            }
            console.log(source[i].getBoundingClientRect().height)
            fullsource = fullsource + source[i].innerHTML;
            fullsourceheight = fullsourceheight + source[i].getBoundingClientRect().height;
            i=i+1;
        }
        if (pagenumber == 1)
        {
            fullsource=fullsource+"</div><p></p>";
                fullsourceheight =0;
                worker = worker
                .get('pdf')
                .then(pdf => {
                pdf.addPage()
                })
                .from(fullsource)
                .toContainer()
                .toCanvas()
                .toPdf()
        }
        worker.save();}