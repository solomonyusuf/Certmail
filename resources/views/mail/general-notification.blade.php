 <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>.NG Token</title>
                </head>
                <body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif; background-color: #f5f5f5;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f5f5f5;">
                        <tr>
                            <td style="padding: 40px 20px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: 0 auto; background-color: #ffffff;">
                                    
                                    <!-- Header -->
                            <tr>
                                <td style="padding: 32px 40px; vertical-align: middle;">
                                    
                                    <!-- Right-aligned logo -->
                                    <img src="{{ asset('logo.png') }}" 
                                        alt="NiRA" 
                                        style="height: 48px; display: inline-block; float: right;">

                                    <!-- Left-aligned logo -->
                                    <img src="{{ asset('nira-logo.png') }}" 
                                        alt="NiRA" 
                                        style="height: 48px; display: inline-block;">

                                </td>
                            </tr>


                                    
                                    <!-- Content -->
                                    <tr>
                                        <td style="padding: 48px 40px;">
                                            <h1 style="color: #1a1a1a; font-size: 24px; font-weight: 600; margin: 0 0 24px 0; line-height: 1.3;">
                                                 .NG Token Permission
                                            </h1>
                                            
                                            <p style="color: #4a4a4a; font-size: 16px; line-height: 1.6; margin: 0 0 16px 0;">
                                                Dear {{ $user->name }},
                                            </p>
                                            
                                            <p style="color: #4a4a4a; font-size: 16px; line-height: 1.6; margin: 0 0 24px 0;">
                                                {{ $body }}
                                            </p>
                                            
                                            <p style="color: #4a4a4a; font-size: 20px; line-height: 1.6; font-weight:bolder; margin: 0 0 24px 0;">
                                                {{ $token }}
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
                                                academy@nira.org.ng<br>
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