<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="text/javascript">
        window.yconnectInit = function() {
            YAHOO.JP.yconnect.Authorization.init({
                button: {
                    format: "image",
                    type: "a",
                    textType:"a",
                    width: 196,
                    height: 38,
                    className: "yconnectLogin"
                },
                authorization: {
                    clientId: "{$client_id}",
                    redirectUri: "{$redirect_uri}",
                    scope: "openid",
                    state: "{$state}",
                    nonce: "{$nonce}",
                    windowWidth: "500",
                    windowHeight: "400"
                },
                onError: function(res) {
                    // エラー発生時のコールバック関数
                },
                onCancel: function(res) {
                    // 同意キャンセルされた時のコールバック関数
                }
            });
        };
        (function(){
            var fs = document.getElementsByTagName("script")[0], s = document.createElement("script");
            s.setAttribute("src", "https://s.yimg.jp/images/login/yconnect/auth/1.0.3/auth-min.js");
            fs.parentNode.insertBefore(s, fs);
        })();

    </script>

</head>
<body>

    <p>下記からログインしてください。</p>
    <span class="yconnectLogin"></span>




</body>
</html>