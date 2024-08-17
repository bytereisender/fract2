import styles from './fract2-info-card.css' assert { type: 'css' };

class Fract2InfoCard extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: 'open' });
    }

    static get observedAttributes() {
        return ['title', 'image', 'expandable'];
    }

    connectedCallback() {
        this.shadowRoot.adoptedStyleSheets = [styles];
        this.render();
    }

    attributeChangedCallback(name, oldValue, newValue) {
        this.render();
    }

    render() {
        const title = this.getAttribute('title') || 'Info Card';
        const image = this.getAttribute('image');
        const expandable = this.hasAttribute('expandable');

        this.shadowRoot.innerHTML = `
            <div class="card-title">${title}</div>
            ${image ? `<img class="card-image" src="${image}" alt="${title}">` : ''}
            <div class="card-content">
                <slot></slot>
            </div>
            ${expandable ? '<button class="expand-btn">Expand</button>' : ''}
        `;

        if (expandable) {
            const btn = this.shadowRoot.querySelector('.expand-btn');
            const content = this.shadowRoot.querySelector('.card-content');
            btn.addEventListener('click', () => {
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                    btn.textContent = 'Expand';
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                    btn.textContent = 'Collapse';
                }
            });
        }
    }
}

customElements.define('fract2-info-card', Fract2InfoCard);