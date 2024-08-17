export class Fract2BaseComponent extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: 'open' });
    }

    async connectedCallback() {
        await this.loadStyles();
        this.render();
        this.setupEventListeners();
    }

    async loadStyles() {
        const styles = await this.getStyles();
        const styleSheet = new CSSStyleSheet();
        await styleSheet.replace(styles);
        this.shadowRoot.adoptedStyleSheets = [styleSheet];
    }

    async getStyles() {
        // Diese Methode sollte in abgeleiteten Klassen überschrieben werden
        return '';
    }

    render() {
        // Diese Methode sollte in abgeleiteten Klassen überschrieben werden
        this.shadowRoot.innerHTML = '<slot></slot>';
    }

    setupEventListeners() {
        // Diese Methode kann in abgeleiteten Klassen überschrieben werden
    }

    static get observedAttributes() {
        return [];
    }

    attributeChangedCallback(name, oldValue, newValue) {
        this.render();
    }
}