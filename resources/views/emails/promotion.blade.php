<div style="font-family: 'Plus Jakarta Sans', sans-serif; max-width: 600px; margin: auto; padding: 40px; background-color: #f8fafc; border-radius: 24px; border: 1px solid #e2e8f0;">
    <div style="text-align: center; margin-bottom: 32px;">
        <div style="display: inline-block; width: 48px; height: 48px; background-color: #4f46e5; border-radius: 12px; line-height: 48px; color: white; font-weight: 900; font-size: 24px;">S</div>
        <h1 style="color: #0f172a; margin-top: 16px; font-size: 24px; font-weight: 800; letter-spacing: -0.025em;">SinodTech <span style="color: #4f46e5;">ERP</span></h1>
    </div>

    <div style="background-color: white; padding: 32px; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #1e293b; font-size: 20px; font-weight: 700; margin-bottom: 16px;">Hello, {{ $customer->name }}!</h2>
        <h3 style="color: #4f46e5; font-size: 18px; font-weight: 600; margin-bottom: 12px;">{{ $promoTitle }}</h3>
        <p style="color: #475569; line-height: 1.6; font-size: 16px;">{{ $promoContent }}</p>
        
        <div style="margin-top: 32px; text-align: center;">
            <a href="{{ config('app.url') }}" style="display: inline-block; background-color: #4f46e5; color: white; padding: 14px 28px; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 14px; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);">Shop Now</a>
        </div>
    </div>

    <div style="text-align: center; margin-top: 32px;">
        <p style="color: #94a3b8; font-size: 12px;">© 2026 SinodTech ERP. All rights reserved.</p>
        <p style="color: #94a3b8; font-size: 12px; margin-top: 4px;">You are receiving this email because you are a valued customer of SinodTech.</p>
    </div>
</div>
