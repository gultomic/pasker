require('./bootstrap');

import Alpine from 'alpinejs'
import Moment from 'moment'
import 'moment/locale/id'

window.moment = Moment

Alpine.data('mainFrame', () => ({
    fullSidebar: true,
    init() {
        let _fs = localStorage.getItem('fullSidebar')

        _fs !== null
            ? this.fullSidebar = JSON.parse(_fs)
            : localStorage.setItem('fullSidebar', true)
    },
    toggleSidebar() {
        this.fullSidebar = !this.fullSidebar
        localStorage.setItem('fullSidebar', this.fullSidebar)
    },
}))

window.Alpine = Alpine

Alpine.start()
