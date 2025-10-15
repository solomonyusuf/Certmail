<div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6">
    <link rel="stylesheet"
        href="https://cdn.ckeditor.com/4.14.1/full-all/plugins/codesnippet/lib/highlight/styles/monokai_sublime.css">
    <style>
        .cke_notifications_area {
            display: none;
        }
    </style>
    <form action="{{ route('save_certificate') }}" method="POST">
        @csrf

        <!-- CKEditor Textarea -->
        <div class="mb-4">
            <textarea name="content" id="invitation" class="w-full border rounded-md focus:ring focus:ring-indigo-300">
               {{ $certificate }}
            </textarea>
            <input name="id" value="{{ $tranning->id }}" hidden />
        </div>

        <!-- Buttons -->
        <div class="flex items-center gap-3">
            <button type="submit"
                class="px-6 py-2 rounded-lg bg-green-500 text-white font-semibold hover:bg-green-600 transition">
                Save Certificate
            </button>
        </div>

    </form>

    <!-- CKEditor Scripts -->
    <script src="//cdn.ckeditor.com/4.14.1/full-all/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/4.14.1/full-all/plugins/codesnippet/lib/highlight/highlight.pack.js"></script>

    <script>
        document.querySelectorAll('textarea:not(.ignore-editor):not(.swal2-textarea)').forEach(function (textarea) {
            if (textarea.id && !textarea.closest('.swal2-container')) {
                CKEDITOR.replace(textarea.id, {
                    allowedContent: true,
                    extraPlugins: 'uploadimage,image2',
                    removePlugins: 'easyimage,cloudservices',
                    height: 900,
                    filebrowserUploadUrl: "{{ route('upload_image', ['_token' => csrf_token()]) }}",
                    filebrowserUploadMethod: 'form',
                });
            }
        });
    </script>
</div>