import {Controller} from '@hotwired/stimulus'

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    answer(e) {
        e.preventDefault();
        let url = e.currentTarget.href
        const isCorrectAnswer = window.confirm('Générer une réponse correcte ?')
        if (isCorrectAnswer) {
            url = url.replace(/\/0/g, "/1")
        }

        window.location.href = url
    }
}
