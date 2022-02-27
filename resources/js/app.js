import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

// ElementPlus
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import esES from 'element-plus/es/locale/lang/es'

require('./bootstrap')

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => require(`./Pages/${name}.vue`),
  setup ({ el, app, props, plugin }) {
    return createApp({ render: () => h(app, props) })
      .use(plugin)
      .use(ElementPlus, { size: 'small', zIndex: 3000, locale: esES })
      .mixin({ methods: { route } })
      .mount(el)
  }
})

InertiaProgress.init({ color: '#4B5563' })
