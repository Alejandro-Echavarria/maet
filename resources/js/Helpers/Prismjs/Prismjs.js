const PrismjsHelper = () => {
    const src = "/vendor/prismjs/prism.js";
    const existScript = document.querySelector(`script[src="${src}"]`);
    const styles = "/vendor/prismjs/prism.css";
    const existStyle = document.querySelector(`link[href="${styles}"]`);

    if (!existStyle) {
        createElement("link", styles);
    }

    if (!existScript) {
        createElement("script", src);
    } else {
        deleteElement(existScript);
        createElement("script", src);
    }
};

const createElement = (type, src) => {
    const element = document.createElement(type);
    switch (type) {
        case "link":
            element.rel = "stylesheet";
            element.href = src;
            document.head.appendChild(element);
            break;
        case "script":
            element.src = src;
            document.body.appendChild(element);
            break;
    }
};

const deleteElement = (element) => {
    element.remove();
};

export default PrismjsHelper;
