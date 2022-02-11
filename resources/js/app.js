require('./bootstrap');

import Alpine from 'alpinejs'
import Moment from 'moment'
import 'moment/locale/id'

window.moment = Moment

Alpine.data('mainFrame', () => ({
    paginate: 10,
    total: '',
    collection: {},
    pageCount: 0,
    pageNumber: 0,
    displayTable: {},
    alpTable (payload) {
        this.total = payload.length
        this.pageCount = Math.ceil(this.total / this.paginate) - 1
        this.collection = payload
        this.rowTable()
    },
    rowTable() {
        const start = this.pageNumber * this.paginate, end = start + this.paginate
        this.displayTable = this.collection.slice(start, end)
    },
    async nextPage() {
        this.pageNumber++
        this.rowTable()
    },
    prevPage() {
        this.pageNumber--
        this.rowTable()
    },
    viewPage(index) {
        this.pageNumber = index
        this.rowTable()
    },
    alpPaginate(value){
        this.paginate = value
        this.pageCount = Math.ceil(this.total / this.paginate) - 1
        this.rowTable()
    }
}))
window.Alpine = Alpine

Alpine.start()
