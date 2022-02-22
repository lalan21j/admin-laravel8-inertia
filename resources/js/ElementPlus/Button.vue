<template>
  <el-button :type="type">{{ text }}</el-button>
</template>

<script>
export default {
  name: "element.plus.button",
  props: {
    type: {
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

</style>