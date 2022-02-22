<template>
  <el-link :type="type" :href="href" class="my-2 ml-2">{{ text }}</el-link>
</template>

<script>
export default {
  name: "element.plus.link",
  props: {
    type: {
      type: String,
      default: ''
    },
    href: {
      type: String,
      default: ''
    },
    text: {
      type: String,
      default: 'Button'
    }
  }
}
</script>

<style scoped>
el-link--inner:hover {
  color: #ffff;
  text-decoration: none !important;
}
</style>