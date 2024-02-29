const CkeditorHelper = (needTimeToLoad = false) => {
    const src = '/vendor/ckeditor5-build-balloon/build/ckeditor.js';
    const existScript = document.querySelector(`script[src="${src}"]`);

    if (!existScript) {
        const script = document.createElement('script');
        script.src = src;

        if (needTimeToLoad) {
            document.head.appendChild(script);
        } else {
            document.addEventListener('DOMContentLoaded', () => {
                document.head.appendChild(script);
            });
        }
    }
}

export default CkeditorHelper;