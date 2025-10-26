<div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
   <div class="flex flex-col items-center gap-4 px-5 mt-4" >
    <!-- Download Button -->
    <button id="downloadBtn" type="button"
        class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 4v4m0 0h4m-4-4H8m4 4v8m4-12h-8a2 2 0 00-2 2v12a2 2 0 002 2h4a2 2 0 002-2v-4h2a2 2 0 002-2V8l-4-4z" />
        </svg>
        Download Certificate
    </button>
    <!-- Canvas -->
    <div class="mb-4" id="certificate">
        <canvas id="myCanvas" width="500" height="500"></canvas>
        <img id="myImage" src="{{ asset($certificate ?? 'cert.png') }}" style="display:none;" /> 
    </div>

    
</div>


       <script>
        const canvas = document.getElementById('myCanvas');
        const ctx = canvas.getContext('2d');
        const img = document.getElementById('myImage');

        img.onload = function() {
        const targetHeight = 500; // visible height in pixels
        const scale = targetHeight / img.naturalHeight;
        const scaledWidth = img.naturalWidth * scale;

        const dpr = window.devicePixelRatio || 1; // high DPI support

        // Set internal canvas resolution (actual pixels)
        canvas.width = scaledWidth * dpr;
        canvas.height = targetHeight * dpr;

        // Set CSS display size (visual size on screen)
        canvas.style.width = scaledWidth + "px";
        canvas.style.height = targetHeight + "px";

        // Scale context to match device pixel ratio
        ctx.scale(dpr, dpr);

        // Draw sharp image
        ctx.drawImage(img, 0, 0, scaledWidth, targetHeight);

        ctx.font = "bold 12px Arial";  
        ctx.fillStyle = "black";
        ctx.textAlign = "left";       
        ctx.textBaseline = "top";    
        ctx.fillText("2012", 70, 50); 


        // === 1️⃣ Name ===
        ctx.font = "bold 22px Arial"; // larger and bold
        ctx.fillStyle = "black";
        ctx.textAlign = "center";
        ctx.textBaseline = "middle";
        ctx.fillText("{{ $student->name }}", scaledWidth / 2, targetHeight / 2 - 10);

        // === 2️⃣ Program Title ===
        ctx.font = "italic 18px Georgia"; // elegant italic font
        ctx.fillStyle = "black"; // dark gray
        ctx.fillText("{{ $tranning->title }}", scaledWidth / 2, targetHeight / 2 + 50);

        // === 3️⃣ Date ===
        ctx.font = "16px Georgia"; // smaller, simple
        ctx.fillStyle = "#555"; // lighter gray
        const certDate = "{{ strtoupper($formattedDate) }}";
        ctx.fillText(certDate, scaledWidth / 2, targetHeight / 2 + 90);
        };
</script>
        
            <script>
                document.getElementById('downloadBtn').addEventListener('click', () => {
                    const element = document.getElementById('certificate');

                    // Optional: hide the button before capture
                    document.getElementById('downloadBtn').style.display = 'none';

                    const opt = {
                        margin:       50,
                        filename:     '{{ $student->name }} - certificate.pdf',
                        image:        { type: 'jpeg', quality: 1 },
                        html2canvas: { 
                            scale: 4,
                            useCORS: true,
                            scrollY: 0,  // prevent cut-off from scroll position
                            // windowWidth: element.scrollWidth,  // capture full width
                            // windowHeight: element.scrollHeight // capture full height
                        },
                        jsPDF: { unit: 'px', format: 'a2', orientation: 'portrait' } 
                    };

                    html2pdf()
                        .from(element)
                        .set(opt)
                        .save()
                        .then(() => {
                            // Restore button visibility after download
                            document.getElementById('downloadBtn').style.display = 'flex';
                        });
                });
                </script>

</div>
