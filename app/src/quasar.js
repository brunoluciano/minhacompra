import Vue from 'vue'

import './styles/quasar.sass'
import lang from 'quasar/lang/pt-br.js'
import '@quasar/extras/material-icons/material-icons.css'
import '@quasar/extras/material-icons-outlined/material-icons-outlined.css'
import '@quasar/extras/material-icons-round/material-icons-round.css'
import '@quasar/extras/material-icons-sharp/material-icons-sharp.css'
import '@quasar/extras/fontawesome-v5/fontawesome-v5.css'
import '@quasar/extras/mdi-v5/mdi-v5.css'
import { Quasar, Loading, QSpinnerPuff } from 'quasar'

Vue.use(Quasar, {
    config: {},
    components: { QSpinnerPuff },
    directives: { /* not needed if importStrategy is not 'manual' */ },
    plugins: { Loading },
    lang: lang
})