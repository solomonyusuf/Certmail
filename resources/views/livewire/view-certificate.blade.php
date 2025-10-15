<div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <button id="downloadBtn" type="button"
        class="mt-5 mb-5 flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 4v4m0 0h4m-4-4H8m4 4v8m4-12h-8a2 2 0 00-2 2v12a2 2 0 002 2h4a2 2 0 002-2v-4h2a2 2 0 002-2V8l-4-4z" />
            </svg>
            Download Certificate
    </button>
    <div  id="certificate">
        {!! $certificate !!}
    </div>
        
            <script>
                document.getElementById('downloadBtn').addEventListener('click', () => {
                    const element = document.getElementById('certificate');

                    // Optional: hide the button before capture
                    document.getElementById('downloadBtn').style.display = 'none';

                    const opt = {
                        margin:       50,
                        filename:     'certificate.pdf',
                        image:        { type: 'jpeg', quality: 1 },
                        html2canvas: { 
                            scale: 4,
                            useCORS: true,
                            scrollY: 0,  // prevent cut-off from scroll position
                            // windowWidth: element.scrollWidth,  // capture full width
                            // windowHeight: element.scrollHeight // capture full height
                        },
                        jsPDF: { unit: 'px', format: 'a1', orientation: 'portrait' } 
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
