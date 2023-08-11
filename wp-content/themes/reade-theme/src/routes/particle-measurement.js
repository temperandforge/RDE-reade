import Calculator from '../components/calculator.svelte'
const { $ } = window
const $body = $(document.body)


export default {
   init() {
      const calculator = document.querySelector('#calculator-wrap')
      if( calculator ) {
         new Calculator({
            target: calculator,
            props: $(calculator).data()
         })
      }
   },
   finalize() {

   },
}
