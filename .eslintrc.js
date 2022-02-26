module.exports = {
  env: {
    browser: true,
    es2021: true
  },
  extends: [
    'plugin:vue/base',
    'plugin:vue/vue3-essential',
    'plugin:vue/vue3-strongly-recommended',
    'plugin:vue/vue3-recommended',

    'eslint:recommended',
    'standard'
  ],
  parserOptions: {
    sourceType: 'module'
  },
  plugins: [
    'vue'
  ],
  rules: {
  }
}
