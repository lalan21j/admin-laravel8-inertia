<template>
  <app-layout>
    <el-row :gutter="20">
      <el-col :xs="24" :md="16">
        <ele-card title="Gesti&oacute;n de men&uacute;">
          <el-form :model="form" label-position="top">
            <el-row :gutter="20">
              <el-col :xs="24" :md="12">
                <el-form-item>
                  <template #label>
                    <span>Nombre</span>
                    <el-tooltip
                      class="box-item"
                      effect="dark"
                      content="Nombre representativo para la opción del menú"
                      placement="top-start"
                    >
                      <span>
                        <information-circle-icon class="w-4 float-right" />
                      </span>
                    </el-tooltip>
                  </template>
                  <el-input v-model="form.label" />
                  <span v-if="errors.label" class="text-red-500 text-xs">{{ errors.label[0] }}</span>
                </el-form-item>
              </el-col>
              <el-col :xs="24" :md="12">
                <el-form-item>
                  <template #label>
                    <span>URL</span>
                    <el-tooltip
                      class="box-item"
                      effect="dark"
                      placement="top-start"
                    >
                      <template #content>
                        Dirección URL a la que respondera la opción. <b>Ejm. /user/view</b>
                        <br><br><b>No llenar si esta tendrá sub-menú</b>
                      </template>
                      <span>
                        <information-circle-icon class="w-4 float-right" />
                      </span>
                    </el-tooltip>
                  </template>
                  <el-input v-model="form.url" />
                  <span v-if="errors.url" class="text-red-500 text-xs">{{ errors.url[0] }}</span>
                </el-form-item>
              </el-col>
            </el-row>

            <el-row :gutter="20">
              <!-- el-col :xs="24" :md="12" v-if="childrenCount">
                <el-form-item label="¿Menú principal?">
                  <el-select v-model="form.parent_node" style="width: 100%">
                    <el-option selected label="Si" value="true" />
                    <el-option label="No" value="false" />
                  </el-select>
                </el-form-item>
              </el-col -->
              <el-col :xs="24" :md="12" v-if="childrenCount && form.url">
                <el-form-item>
                  <template #label>
                    <span>Menú principal</span>
                    <el-tooltip
                      class="box-item"
                      effect="dark"
                      placement="top-start"
                    >
                      <template #content>
                        Solo seleccionar si será un sub-menú
                      </template>
                      <span>
                        <information-circle-icon class="w-4 float-right" />
                      </span>
                    </el-tooltip>
                  </template>
                  <el-select v-model="form.menu_id" style="width: 100%">
                    <el-option v-for="items in menu" :key="items.id" :label="items.label" :value="items.id" />
                  </el-select>
                </el-form-item>
              </el-col>
              <el-col :xs="24" :md="12">
                <el-form-item label="Icono">
                  <el-select v-model="form.icon" style="width: 100%">
                    <el-option label="Si" value="true" />
                  </el-select>
                </el-form-item>
              </el-col>
            </el-row>

            <!-- el-row :gutter="20">
              <el-col :xs="24" :md="12" v-if="form.url">
                <el-form-item>
                  <template #label>
                    <span>¿CRUD completo?</span>
                    <el-tooltip
                      class="box-item"
                      effect="dark"
                      placement="top-start"
                    >
                      <template #content>
                        Se genera las opciones típicas del CRUD <b>(Crear, Leer, Actualizar, Eliminar)</b>
                        <br><br><b><span>/user/index</span>
                        <br><span>/user/view</span>
                        <br><span>/user/update</span>
                        <br><span>/user/delete</span></b>
                      </template>
                      <span>
                        <information-circle-icon class="w-4 float-right" />
                      </span>
                    </el-tooltip>
                  </template>
                  <el-select v-model="form.crud" style="width: 100%">
                    <el-option label="Si" value="true" />
                    <el-option label="No" value="false" />
                  </el-select>
                  <span v-if="errors.crud" class="text-red-500 text-xs">{{ errors.crud[0] }}</span>
                </el-form-item>
              </el-col>
              <el-col :xs="24" :md="12" v-if="form.url">
                <el-form-item>
                  <template #label>
                    <span>¿Incluir reportes?</span>
                    <el-tooltip
                      class="box-item"
                      effect="dark"
                      placement="top-start"
                    >
                      <template #content>
                        Se genera las opciones para los reportes (.pdf, hoja de cálculo)
                        <br><br><b>No llenar si tendrá sub-menú</b>
                        <br><br><b><span>/user/pdf</span>
                        <br><span>/user/spreadsheet</span></b>
                      </template>
                      <span>
                        <information-circle-icon class="w-4 float-right" />
                      </span>
                    </el-tooltip>
                  </template>
                  <el-select v-model="form.report" style="width: 100%">
                    <el-option label="Si" value="true" />
                    <el-option label="No" value="false" />
                  </el-select>
                  <span v-if="errors.report" class="text-red-500 text-xs">{{ errors.report[0] }}</span>
                </el-form-item>
              </el-col>
            </el-row -->

            <!-- el-row :gutter="20">
              <el-col :xs="24" :md="12">
                <el-form-item label="Icono">
                  <el-select v-model="form.icon" style="width: 100%">
                    <el-option label="Si" value="true" />
                  </el-select>
                </el-form-item>
              </el-col>
            </el-row -->

            <el-form-item label="Descripción">
              <el-input v-model="form.description" autocomplete="off" />
              <span v-if="errors.description" class="text-red-500 text-xs">{{ errors.description[0] }}</span>
            </el-form-item>

            <el-form-item class="float-right mt-9">
              <ele-button type="success" @click="save" :loading="loadBtn" >
                Aceptar
              </ele-button>
            </el-form-item>
          </el-form>
        </ele-card>
      </el-col>
      <el-col :xs="24" :md="8">
        <ele-card title="Estructura">
          <el-tree ref="treePermissions" :data="tree" :props="defaultProps" node-key="id" show-checkbox  @check="getChecked" :default-checked-keys="marked" :default-expanded-keys="[1]" />
        </ele-card>

        <ele-button type="success" :loading="loadBtn" >
          Aceptar
        </ele-button>
      </el-col>
    </el-row>
  </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import EleButton from '@/ElementPlus/Button.vue'
import EleCard from '@/ElementPlus/Card.vue'
import { InformationCircleIcon } from '@heroicons/vue/outline'

export default defineComponent({
  name: 'teamsMenuIndex',
  components: {
    AppLayout, EleButton, EleCard, InformationCircleIcon
  },
  data () {
    return {
      form: {},
      errors: {},
      loadBtn: false,

      menu: {},

      defaultProps: {
        children: 'children',
        label: 'label'
      },
      tree: [],
      childrenCount: 0,
      marked: []
    }
  },
  mounted () {
    // this.marked = [3, 7, 10]
    this.getMenuTree()
    this.getMenu()
  },
  methods: {
    getChecked () {
      this.form.menu = this.$refs.treePermissions.getCheckedKeys()
    },
    async getMenu () {
      const menu = await axios.get('/menu')
      this.menu = menu.data
      console.log(this.menu)
    },
    async getMenuTree () {
      const menuTree = await axios.get('/menu/tree')
      this.tree = Array(menuTree.data)
      this.childrenCount = this.tree[0].children.length
    },
    async save () {
      this.loadBtn = true

      await axios({
        method: (this.form.id) ? 'put' : 'post',
        url: (this.form.id) ? '/menu/' + this.form.id : '/menu',
        data: this.form
      }).then((response) => {
        this.$message({
          message: response.data.message,
          type: (response.status === 201 || response.status === 200) ? 'success' : 'error'
        })
      }).then(() => {
        this.errors = {}
        this.form = {}
        this.loadBtn = false
        this.getMenuTree()
        this.getMenu()
      }).catch((err) => {
        if (err.response.status === 422) {
          this.errors = err.response.data.errors
        }
        this.loadBtn = false
      })
    }
  }
})
</script>

<style scoped></style>
