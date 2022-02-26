<template>
  <el-dialog v-model="$props.dialogVisible" title="Agregar rol" :before-close="closeModal" :close-on-click-modal="false" :close-on-press-escape="false" draggable>
    <el-form :model="form" label-position="top">
      <el-form-item label="Nombre">
        <el-input v-model="form.name" />
        <span v-if="errors.name" class="text-red-500 text-xs">{{ errors.name[0] }}</span>
      </el-form-item>
      <el-form-item label="Permisos">
        <el-checkbox-group v-model="form.permission">
          <el-checkbox label="read" name="type">Ver</el-checkbox>
          <el-checkbox label="create" name="type">Crear</el-checkbox>
          <el-checkbox label="update" name="type">Editar</el-checkbox>
          <el-checkbox label="delete" name="type">Eliminar</el-checkbox>
        </el-checkbox-group>
        <span v-if="errors.permission" class="text-red-500 text-xs w-full">{{ errors.permission[0] }}</span>
      </el-form-item>
      <el-form-item label="Descripción">
        <el-input v-model="form.description" autocomplete="off" />
        <span v-if="errors.description" class="text-red-500 text-xs">{{ errors.description[0] }}</span>
      </el-form-item>
    </el-form>
    <template #footer>
      <span class="dialog-footer">
        <el-button @click="closeModal">Cancelar</el-button>
        <el-button type="primary" :loading="loadBtn" @click="save">Confirmar</el-button>
      </span>
    </template>
  </el-dialog>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  name: "teams.roles.modal",
  props: {
    dialogVisible: {
      type: Boolean,
      require: true,
      default: false
    }
  },
  data () {
    return {
      form: {},
      errors: {},
      loadBtn: false
    }
  },
  methods: {
    async save () {
      this.loadBtn = true
      await axios({
        method: (this.form.id) ? 'put' : 'post',
        url: (this.form.id) ? '/role/' + this.form.id : '/role',
        data: this.form
      }).then((response) => {
        this.$message({
          message: response.data.message,
          type: (response.status === 201 || response.status === 200) ? 'success' : 'error'
        })
      }).then(() => {
        this.errors = {}
        this.loadBtn = false
        this.$emit('updateRecords')
      }).catch((err) => {
        if (err.response.status === 422) {
          this.errors = err.response.data.errors
        }
        this.loadBtn = false
      })
    },
    deleteContact (item) {
      this.$confirm('¿Desea eliminar el registro?', 'Aviso', {
        confirmButtonText: 'Borrar',
        cancelButtonText: 'Cancelar',
        type: 'warning'
      }).then(() => {
        axios.delete('/contact/' + item).then((response) => {
          this.$message({
            message: response.data.message,
            type: (response.status === 201 || response.status === 200) ? 'success' : 'error'
          })
        }).then(() => {
          this.$emit('updateData')
        })
      }).catch(() => {
        /* this.$message({
          type: 'info',
          message: 'Delete canceled'
        }) */
      })
    },
    closeModal () {
      this.form = {}
      this.errors = {}
      this.$emit('close', false)
    }
  }
})
</script>

<style scoped>

</style>
