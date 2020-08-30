<template>
  <md-card class="mb">
    <md-card-header>
      <div class="md-title">
        {{ title }}
      </div>
    </md-card-header>
    <md-card-content>
      <form @submit.prevent="save(settingId)">
        <md-field>
          <md-input v-model="setValue" :placeholder="placeholder" />
        </md-field>
        <md-button type="submit" class="md-raised md-primary">
          Сохранить
        </md-button>
      </form>
    </md-card-content>
  </md-card>
</template>

<script>
import { update } from '../../../api/api'
export default {
  name: 'SettingItem',
  props: {
    settingId: {
      type: Number,
      required: true
    },
    value: {
      type: String,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    placeholder: {
      type: String,
      default: () => ''
    }
  },
  data() {
    return {
      setValue: ''
    }
  },
  watch: {
    value(value) {
      this.setValue = value
    }
  },
  methods: {
    save(id) {
      update('settings', id, { value: this.setValue }).then((res) => {
        this.$toast.success(res.data.success)
        if (id === 3) this.$store.dispatch('updateSiteLogo', this.setValue)
      }).catch((err) => {
        this.$toast.warning(err.response.data.errors)
      })
    }
  }
}
</script>

<style scoped>
.mb {
    margin-bottom: 15px;
}
</style>
