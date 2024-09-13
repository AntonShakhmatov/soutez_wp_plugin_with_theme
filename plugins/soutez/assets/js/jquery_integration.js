function load_jquery() {
    if (!window.jQuery) {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
        document.body.appendChild(script);
    }
}
load_jquery();