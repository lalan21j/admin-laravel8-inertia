<template>
  <el-button :type="type">
    <slot />
  </el-button>
</template>

<script>
export default {
  name: 'ElementPlusButton',
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
