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
                            <title>Your Certificate is Ready!</title>
                        </head>
                        <body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f4f4f4;">
                                <tr>
                                    <td style="padding: 20px 0;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                            
                                            <!-- Logo Section -->
                                            <tr>
                                                <td style="background: linear-gradient(135deg, #1a5f3f 0%, #2d8f5f 100%); padding: 40px 30px; text-align: center;">
                                                    <!-- Replace src with your company logo URL -->
                                                    <img src="{{ asset('logo.png') }}" alt="Company Logo" style="max-width: 200px; height: auto; display: block; margin: 0 auto;">
                                                </td>
                                            </tr>
                                            
                                            <!-- Main Content -->
                                            <tr>
                                                <td style="padding: 40px 30px;">
                                                    <h1 style="color: #1a5f3f; font-size: 28px; margin: 0 0 20px 0; text-align: center;">Congratulations, [Student Name]!</h1>
                                                    
                                                    <p style="color: #333333; font-size: 16px; line-height: 1.6; margin: 0 0 20px 0;">
                                                        We are delighted to inform you that you have successfully completed the <strong style="color: #1a5f3f;">[Training Program Name]</strong> training program.
                                                    </p>
                                                    
                                                    <p style="color: #333333; font-size: 16px; line-height: 1.6; margin: 0 0 30px 0;">
                                                        Your dedication and hard work throughout this program have been exemplary. We're proud to present you with your certificate of completion.
                                                    </p>
                                                    
                                                    <!-- Certificate Preview Box -->
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 0 30px 0;">
                                                        <tr>
                                                            <td style="background-color: #f8f9fa; border-left: 4px solid #1a5f3f; padding: 20px; border-radius: 4px;">
                                                                <p style="color: #666666; font-size: 14px; margin: 0 0 10px 0; font-weight: bold;">
                                                                    📜 Certificate Details:
                                                                </p>
                                                                <p style="color: #333333; font-size: 14px; line-height: 1.5; margin: 0;">
                                                                    <strong>Name:</strong> [Student Name]<br>
                                                                    <strong>Program:</strong> [Training Program Name]<br>
                                                                    <strong>Completion Date:</strong> [Date]<br>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    
                                                    <!-- CTA Button -->
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 0 30px 0;">
                                                        <tr>
                                                            <td style="text-align: center;">
                                                                <a href="[CERTIFICATE_DOWNLOAD_LINK]" download style="display: inline-block; background: linear-gradient(135deg, #1a5f3f 0%, #2d8f5f 100%); color: #ffffff; text-decoration: none; padding: 15px 40px; border-radius: 5px; font-size: 16px; font-weight: bold; box-shadow: 0 4px 6px rgba(26, 95, 63, 0.3);">
                                                                    Download Your Certificate
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    
                                                    <p style="color: #666666; font-size: 14px; line-height: 1.6; margin: 0 0 20px 0; text-align: center;">
                                                        You can also view and share your certificate on your professional profiles.
                                                    </p>
                                                    
                                                    <!-- Divider -->
                                                    <hr style="border: none; border-top: 1px solid #e0e0e0; margin: 30px 0;">
                                                    
                                                    <p style="color: #333333; font-size: 15px; line-height: 1.6; margin: 0 0 15px 0;">
                                                        <strong>What's Next?</strong>
                                                    </p>
                                                    
                                                    <ul style="color: #666666; font-size: 14px; line-height: 1.8; margin: 0 0 20px 0; padding-left: 20px;">
                                                        <li>Share your achievement on social media</li>
                                                        <li>Add this certificate to your LinkedIn profile</li>
                                                        <li>Explore our advanced training programs</li>
                                                        <li>Join our alumni network for continued learning</li>
                                                    </ul>
                                                    
                                                    <p style="color: #333333; font-size: 15px; line-height: 1.6; margin: 0;">
                                                        Once again, congratulations on this achievement. We look forward to seeing your continued growth and success!
                                                    </p>
                                                </td>
                                            </tr>
                                            
                                            <!-- Footer -->
                                            <tr>
                                                <td style="background-color: #f8f9fa; padding: 30px; text-align: center; border-top: 1px solid #e0e0e0;">
                                                    <p style="color: #1a5f3f; font-size: 16px; font-weight: bold; margin: 0 0 10px 0;">
                                                        Nigeria Internet Registration Association (NiRA)
                                                    </p>
                                                    
                                                    <p style="color: #666666; font-size: 13px; line-height: 1.6; margin: 0 0 15px 0;">
                                                        Building Nigeria's digital future, one domain at a time.
                                                    </p>
                                                    
                                                    <p style="color: #999999; font-size: 12px; line-height: 1.5; margin: 0 0 15px 0;">
                                                        📧 <a href="mailto:admin@nira.org.ng" style="color: #1a5f3f; text-decoration: none;">admin@nira.org.ng</a> | 
                                                        🌐 <a href="https://nira.org.ng" style="color: #1a5f3f; text-decoration: none;">www.nira.org.ng</a>
                                                    </p>
                                                    
                                                   
                                                    
                                                    <p style="color: #999999; font-size: 11px; line-height: 1.5; margin: 20px 0 0 0;">
                                                         If you have any questions, please contact us at admin@nira.org.ng
                                                    </p>
                                                    
                                                    <p style="color: #cccccc; font-size: 10px; margin: 10px 0 0 0;">
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