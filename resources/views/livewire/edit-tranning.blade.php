<div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6">
    <link rel="stylesheet"
        href="https://cdn.ckeditor.com/4.14.1/full-all/plugins/codesnippet/lib/highlight/styles/monokai_sublime.css">
    <style>
        .cke_notifications_area {
            display: none;
        }
    </style>
    <form action="{{ route('send_mail') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="training" class="block text-sm font-medium text-gray-700 mb-1">Select Training</label>
            <select id="training" name="training_id"
                class="w-full border rounded-md px-3 py-2 focus:ring focus:ring-indigo-300">
                <option value="">-- Choose a training --</option>
                @foreach($trainings as $training)
                <option value="{{ $training->id }}">{{ $training->title }}</option>
                @endforeach
            </select>
        </div>

        <!-- CKEditor Textarea -->
        <div class="mb-4">
            <textarea name="content" id="invitation" class="w-full border rounded-md focus:ring focus:ring-indigo-300">
               <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion</title>
</head>
<body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif; background-color: #f5f5f5;">
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f5f5f5;">
        <tr>
            <td style="padding: 40px 20px;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: 0 auto; background-color: #ffffff;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="padding: 32px 40px;">
                            <img src="{{ asset('logo.png') }}" alt="NiRA" style="height: 48px; display: block;">
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 48px 40px;">
                            <h1 style="color: #1a1a1a; font-size: 24px; font-weight: 600; margin: 0 0 24px 0; line-height: 1.3;">
                                Certificate of Completion
                            </h1>
                            
                            <p style="color: #4a4a4a; font-size: 16px; line-height: 1.6; margin: 0 0 16px 0;">
                                Dear [Student Name],
                            </p>
                            
                            <p style="color: #4a4a4a; font-size: 16px; line-height: 1.6; margin: 0 0 24px 0;">
                                This confirms your successful completion of the [Training Program Name] on [Date]. Your certificate is now available for download.
                            </p>
                            
                            <!-- Certificate Info Box -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 0 32px 0; border: 1px solid #e5e5e5; background-color: #fafafa;">
                                <tr>
                                    <td style="padding: 24px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="color: #6a6a6a; font-size: 13px; padding: 0 0 4px 0;">Participant</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #1a1a1a; font-size: 15px; font-weight: 500; padding: 0 0 16px 0;">[Student Name]</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #6a6a6a; font-size: 13px; padding: 0 0 4px 0;">Program</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #1a1a1a; font-size: 15px; font-weight: 500; padding: 0 0 16px 0;">[Training Program Name]</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #6a6a6a; font-size: 13px; padding: 0 0 4px 0;">Completed</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #1a1a1a; font-size: 15px; font-weight: 500;">[Date]</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Download Button -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: 0 0 32px 0;">
                                <tr>
                                    <td style="background-color: #1a5f3f; border-radius: 4px;">
                                        <a href="[CERTIFICATE_DOWNLOAD_LINK]" download style="display: inline-block; color: #ffffff; text-decoration: none; padding: 14px 32px; font-size: 15px; font-weight: 500;">
                                            Download Certificate
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            
                            <p style="color: #4a4a4a; font-size: 16px; line-height: 1.6; margin: 0 0 8px 0;">
                                This certificate may be shared on professional networks and added to your credentials.
                            </p>
                            
                            <p style="color: #4a4a4a; font-size: 16px; line-height: 1.6; margin: 0;">
                                For questions regarding your certificate, please contact us at admin@nira.org.ng.
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="padding: 32px 40px; background-color: #fafafa; border-top: 1px solid #e5e5e5;">
                            <p style="color: #1a1a1a; font-size: 14px; font-weight: 500; margin: 0 0 8px 0;">
                                Nigeria Internet Registration Association
                            </p>
                            
                            <p style="color: #6a6a6a; font-size: 14px; line-height: 1.5; margin: 0 0 16px 0;">
                                admin@nira.org.ng<br>
                                www.nira.org.ng
                            </p>
                            
                            <p style="color: #9a9a9a; font-size: 12px; line-height: 1.5; margin: 0;">
                                © 2025 Nigeria Internet Registration Association. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
            </textarea>
        </div>

        <!-- Buttons -->
        <div class="flex items-center gap-3">
            <button type="submit"
                class="px-6 py-2 rounded-lg bg-green-500 text-white font-semibold hover:bg-green-600 transition">
                Submit Mail
            </button>
        </div>

        <!-- Warning Message -->
        <p class="mt-2 text-sm text-gray-600 italic">
            ⚠️ Note: This process may take up to <span class="font-semibold">5–10 minutes</span> depending on the list.
        </p>
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