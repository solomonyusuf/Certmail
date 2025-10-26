<div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6">
    <link rel="stylesheet"
        href="https://cdn.ckeditor.com/4.14.1/full-all/plugins/codesnippet/lib/highlight/styles/monokai_sublime.css">
    <style>
        .cke_notifications_area {
            display: none;
        }
    </style>
    <form enctype="multipart/form-data" action="{{ route('save_certificate') }}" method="POST">
        @csrf

        <!-- CKEditor Textarea -->
        <div class="mb-4">
            <canvas id="myCanvas" width="500" height="500"></canvas> 
               
             <img id="myImage" src="{{ asset($certificate ?? 'cert.png') }}" style="display:none;" /> 
               
              
            <input name="id" value="{{ $tranning->id }}" hidden />
        </div>

         <!-- Certificate Upload + Save Button -->
        <div class="flex flex-col items-start gap-4">

        <!-- Upload Field -->
        <div class="col-6">
            <label for="certificateUpload" class="block text-sm font-medium text-gray-700 mb-2">
            Upload Certificate
            </label>
            <input 
            type="file" 
            id="certificateUpload" 
            name="image"
            accept="image/png, image/jpeg" 
            class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400"
            />
        </div>

        <!-- Buttons -->
        <div class="flex items-center gap-3">
            <button 
            type="submit"
            class="px-6 py-2 rounded-lg bg-green-500 text-white font-semibold hover:bg-green-600 transition"
            >
            Save Certificate
            </button>
        </div>

        </div>


    </form>

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
        ctx.fillText("Solomon Yusuf", scaledWidth / 2, targetHeight / 2 - 10);

        // === 2️⃣ Program Title ===
        ctx.font = "italic 18px Georgia"; // elegant italic font
        ctx.fillStyle = "black"; // dark gray
        ctx.fillText("Reseller Programme", scaledWidth / 2, targetHeight / 2 + 50);

        // === 3️⃣ Date ===
        ctx.font = "16px Georgia"; // smaller, simple
        ctx.fillStyle = "#555"; // lighter gray
        ctx.fillText("SEPTEMBER 2025", scaledWidth / 2, targetHeight / 2 + 90);
        };
</script>
</div>
