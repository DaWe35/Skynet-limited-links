<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap-grid.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>
    <body>
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="622" viewBox="0 0 622 151" class="top-swoosh"><defs><filter id="a" width="103.4%" height="103.4%" x="-1.7%" y="-1.7%" filterUnits="objectBoundingBox"><feMorphology in="SourceAlpha" operator="dilate" radius="1" result="shadowSpreadOuter1"></feMorphology><feOffset in="shadowSpreadOuter1" result="shadowOffsetOuter1"></feOffset><feMorphology in="SourceAlpha" radius="1" result="shadowInner"></feMorphology><feOffset in="shadowInner" result="shadowInner"></feOffset><feComposite in="shadowOffsetOuter1" in2="shadowInner" operator="out" result="shadowOffsetOuter1"></feComposite><feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="4"></feGaussianBlur><feColorMatrix in="shadowBlurOuter1" values="0 0 0 0 0.341176471 0 0 0 0 0.709803922 0 0 0 0 0.376470588 0 0 0 0.3 0"></feColorMatrix></filter><path id="b" d="M384 768c212.077 0 384-171.923 384-384S596.077 0 384 0 0 171.923 0 384s171.923 384 384 384zm192-51.446c-91.832 53.02-252.238-52.89-358.277-236.554C111.684 296.336 100.168 104.466 192 51.446"></path></defs><g fill="none" fill-rule="evenodd"><g stroke-linejoin="round" transform="translate(-73 -626)"><use fill="#000" filter="url(#a)" xlink:href="#b"></use><use stroke="#2B6CB0" stroke-width="2" xlink:href="#b"></use></g><path fill="#3182CE" d="M119.706-574.998l-.78.524C27.13-521.461 38.642-329.612 144.64-145.968 250.637 37.676 410.982 143.572 502.779 90.559l.218-.052C446.488 123.254 380.859 142 310.853 142 98.857 142-73-29.904-73-241.957c0-142.44 77.542-266.765 192.706-333.04z"></path></g></svg>


        <h1 class="text-center top">Limited Skynet links</h1>
        <p class="text-center top-info">Do not store sensitive data on Skynet
            <span class="tooltip" title="On Skynet, every file is unencrypted, so even if you don't share the link, it may be available in theory. If you still want to store sensitive data, encrypt it before uploading or use Sia without Skynet!">
                <i class="fa fa-info-circle"></i>
            </span>
        </p>
        <div class="border p-3 m-auto">
            <form class="home-upload-retrieve-form p-5 text-center" method="post" action="new">
                <input type="text" name="skylink" placeholder="Skylink" class="big">
                <span class="tooltip" title="For example: CABAB_1Dt0FJsxqsu_J4TodNCbCGvtFf1Uys_3EgzOlTcg">
                    <i class="fa fa-info-circle"></i>
                </span>
                <p>Optional limits <span style="opacity: 0.6">(leave empty what you don't need)<span></p>

                <p>Downloadable <input type="number" name="skylink"> times
                    <span class="tooltip" title="After the file was opened x times, the link won't work.">
                        <i class="fa fa-info-circle"></i>
                    </span>
                </p>

                <p>Expire after <input type="number" name="expire_value" class="mr-0">
                    <select name="expire_unit" class="ml-0">
                        <option value="minutes">Minutes</option>
                        <option value="hours">Hours</option>
                        <option value="days" selected>Days</option>
                        <option value="week">Weeks</option>
                        <option value="months">Months</option>
                    </select>
                    
                    <span class="tooltip" title="After this time, the link won't work.">
                        <i class="fa fa-info-circle"></i>
                    </span>
                </p>

                <p>File password <input type="password" name="password" placeholder="Password">
                    <span class="tooltip" title="The password required to open the file.">
                        <i class="fa fa-info-circle"></i>
                    </span>
                </p>

                
                <button type="submit" class="button"><i class="fa fa-share mr-2"></i>Generate link</button>
            </form>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.0.8/dist/jBox.all.min.js"></script>
        <link href="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.0.8/dist/jBox.all.min.css" rel="stylesheet">

        <script>
            new jBox('Tooltip', {
                attach: '.tooltip',
                    closeOnMouseleave: true
            });
        </script>
    </body>
</html>