<template>
  <el-table :data="records" stripe>
    <slot />
  </el-table>
</template>

<script>
export default {
  name: "element.plus.table",
  props: {
    records: {
      type: Array,
      default: []
    }
  }
}
</script>

<style>
</style>