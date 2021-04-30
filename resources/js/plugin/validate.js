import Vue from 'vue'
import {
    ValidationObserver,
    ValidationProvider,
    localize,
    extend,
} from 'vee-validate'

import * as rules from 'vee-validate/dist/rules'
for (let rule in rules) {
    extend(rule, rules[rule])
}

// 日本語化
import ja from 'vee-validate/dist/locale/ja'
localize('ja', ja)

// コンポーネント設定
Vue.component('ValidationObserver', ValidationObserver)
Vue.component('ValidationProvider', ValidationProvider)