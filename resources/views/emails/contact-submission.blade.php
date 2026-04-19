<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>New Contact Submission</title>
    </head>
    <body style="margin: 0; padding: 0; background: #f2f7ff; font-family: Inter, Arial, sans-serif; color: #1d2745;">
        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="padding: 32px 12px;">
            <tr>
                <td align="center">
                    <table role="presentation" cellpadding="0" cellspacing="0" width="640" style="max-width: 640px; width: 100%; background: #ffffff; border: 1px solid #d9e3f5; border-radius: 18px; overflow: hidden;">
                        <tr>
                            <td style="background: linear-gradient(135deg, #1e2a63 0%, #2f4fc4 100%); padding: 26px 30px;">
                                <p style="margin: 0; font-size: 12px; letter-spacing: 0.08em; text-transform: uppercase; color: #d7e2ff; font-weight: 600;">Pak SMS Connect</p>
                                <h1 style="margin: 10px 0 0; font-size: 26px; line-height: 1.2; color: #ffffff;">New Contact Form Submission</h1>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 28px 30px 12px;">
                                <p style="margin: 0; font-size: 15px; line-height: 1.65; color: #3a456b;">
                                    A new contact request was sent from the website. Details are below.
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 10px 30px 30px;">
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                                    <tr>
                                        <td style="padding: 13px 14px; border: 1px solid #e4ebf8; background: #f9fbff; font-size: 12px; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; color: #51608d;" width="180">Name</td>
                                        <td style="padding: 13px 14px; border: 1px solid #e4ebf8; font-size: 15px; color: #1f2a4c;">{{ $payload['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 13px 14px; border: 1px solid #e4ebf8; background: #f9fbff; font-size: 12px; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; color: #51608d;">Email</td>
                                        <td style="padding: 13px 14px; border: 1px solid #e4ebf8; font-size: 15px; color: #1f2a4c;">
                                            <a href="mailto:{{ $payload['email'] }}" style="color: #2f4fc4; text-decoration: none;">{{ $payload['email'] }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 13px 14px; border: 1px solid #e4ebf8; background: #f9fbff; font-size: 12px; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; color: #51608d;">Subject</td>
                                        <td style="padding: 13px 14px; border: 1px solid #e4ebf8; font-size: 15px; color: #1f2a4c;">{{ $payload['subject'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 13px 14px; border: 1px solid #e4ebf8; background: #f9fbff; font-size: 12px; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; color: #51608d; vertical-align: top;">Message</td>
                                        <td style="padding: 13px 14px; border: 1px solid #e4ebf8; font-size: 15px; color: #1f2a4c; line-height: 1.65; white-space: pre-wrap;">{{ $payload['message'] }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 0 30px 30px;">
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; border: 1px solid #e4ebf8; border-radius: 12px; overflow: hidden;">
                                    <tr>
                                        <td style="padding: 12px 14px; background: #f6f9ff; font-size: 12px; letter-spacing: 0.04em; text-transform: uppercase; font-weight: 600; color: #5d6e9f;" colspan="2">Submission Metadata</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 14px; border-top: 1px solid #e4ebf8; font-size: 13px; color: #4d5c88;" width="180">Submitted</td>
                                        <td style="padding: 10px 14px; border-top: 1px solid #e4ebf8; font-size: 13px; color: #24345f;">{{ $meta['submitted_at'] ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 14px; border-top: 1px solid #e4ebf8; font-size: 13px; color: #4d5c88;">IP Address</td>
                                        <td style="padding: 10px 14px; border-top: 1px solid #e4ebf8; font-size: 13px; color: #24345f;">{{ $meta['ip_address'] ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 14px; border-top: 1px solid #e4ebf8; font-size: 13px; color: #4d5c88;">User Agent</td>
                                        <td style="padding: 10px 14px; border-top: 1px solid #e4ebf8; font-size: 13px; color: #24345f;">{{ $meta['user_agent'] ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 0 30px 28px;">
                                <a href="mailto:{{ $payload['email'] }}" style="display: inline-block; background: linear-gradient(135deg, #1e2a63 0%, #2f4fc4 100%); color: #ffffff; text-decoration: none; padding: 11px 18px; border-radius: 10px; font-size: 14px; font-weight: 600;">
                                    Reply to {{ $payload['name'] }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 16px 30px; border-top: 1px solid #e4ebf8; font-size: 12px; color: #6979a8;">
                                This email was generated by the Pak SMS Connect contact form.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
