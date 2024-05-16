<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bleep-pilot</title>
    <link href="https://cdn.jsdelivr.net/gh/duyplus/fontawesome-pro/css/all.min.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <div style="font-family: sans-serif;  background-color: #edf2f7; padding-top: 64px; padding-bottom: 64px;">

        <div style="max-width: 28rem; margin-left: auto; margin-right: auto;">

            <div style="background-color: #ffffff; padding: 32px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">

                <div style="text-align: center; letter-spacing: 0.05em; border-bottom: 1px solid #cbd5e0;">
                    <div
                        style="color: #e53e3e; font-size: 12px; font-weight: bold; display: flex; justify-content: center; align-items: center;">
                        <img src="{{ asset('images/LOGO.png') }}" style="height:100%" alt="Logo">
                    </div>
                    <h1
                        style="font-size: 1.475rem; margin-top: 1.5rem;  display: flex; align-items: center; justify-content: center;">
                        {!! $data['heading'] !!}</span></h1>
                </div>

                <div style="padding-top: 2rem; padding-bottom: 2rem; border-bottom: 1px solid #cbd5e0;">
                    {!! $data['body'] !!}</span>
                </div>

                <div style="margin-top: 2rem; text-align: center; color: #4a5568;">
                    <h3 style="font-size: 1rem; margin-bottom: 1rem;">Thanks for using The theHotBleep!</h3>
                    <p style="font-size: 0.875rem;">www.thehotbleep.com</p>
                </div>

                <div style="text-align: center; font-size: 0.875rem; color: #4a5568; margin-top: 2rem;">
                    {{-- <div style="display: flex; justify-content: center; margin-bottom: 1rem;">
                        <a href="#"
                            style="display: flex; justify-content: center; align-items: center; background-color: #000000; color: #ffffff; border-radius: 50%; width: 2rem; height: 2rem; text-decoration: none;"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#"
                            style="display: flex; justify-content: center; align-items: center; background-color: #000000; color: #ffffff; border-radius: 50%; width: 2rem; height: 2rem; text-decoration: none; margin-left: 0.75rem;"><i
                                class="fab fa-instagram"></i></a>
                        <a href="#"
                            style="display: flex; justify-content: center; align-items: center; background-color: #000000; color: #ffffff; border-radius: 50%; width: 2rem; height: 2rem; text-decoration: none; margin-left: 0.75rem;"><i
                                class="fab fa-twitter"></i></a>
                    </div> --}}
                    <div>
                        <span style="color: #868686;">Copyright &copy; {{ date('Y') }} theHotBleep. All Rights
                            Reserved. </span>
                    </div>
                    <div style="height: 7px; line-height: 3px; font-size: 1px;"></div>
                    <div>
                        <span style="color: #1a1a1a;">
                            <a href="#" style="color: #4a5568; text-decoration: none;"
                                target="_blank">hello@theHotBleep.com</a>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            {{-- <a href="#" style="color: #4a5568; text-decoration: none;"
                                target="_blank">1(800)232-90-26</a> --}}
                         
                            <a href="#" style="color: #4a5568; text-decoration: none;" target="_blank">theHotBleep</a>
                        </span>
                    </div>
                </div>

            </div>

        </div>

    </div>


</body>

</html>
