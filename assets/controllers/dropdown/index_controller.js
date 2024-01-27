import {Controller} from '@hotwired/stimulus'

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    connect() {
        this.dropdowns = document.querySelectorAll('.app-dropdown')
        this.element.addEventListener('click', this.change.bind(this))
        window.addEventListener('click', this.close.bind(this))
    }

    change(event) {
        this.dropdowns.forEach(dropdown => {
            if (dropdown !== event.currentTarget) {
                dropdown.querySelector('[type="checkbox"]').checked = false
            }
        })
    }

    close(event) {
        this.dropdowns.forEach(dropdown => {
            if (event.target !== dropdown.querySelector('[type="checkbox"]') && !dropdown.contains(event.target)) {
                dropdown.querySelector('[type="checkbox"]').checked = false
            }
        })
    }
}
