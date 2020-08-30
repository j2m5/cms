<template>
  <div>
    <setting-item
      title="Изменить название сайта"
      :setting-id="1"
      :value="settings.siteName"
      placeholder="Введите название"
    />
    <setting-item
      title="Изменить описание сайта"
      :setting-id="2"
      :value="settings.siteDesc"
      placeholder="Введите описание"
    />
    <setting-item
      title="Изменить логотип сайта"
      :setting-id="3"
      :value="settings.siteLogo"
      placeholder="Путь к изображению (относительный путь к изображению)"
    />
    <setting-item
      title="Изменить мета-описание сайта"
      :setting-id="4"
      :value="settings.siteMD"
      placeholder="Введите мета-описание"
    />
    <setting-item
      title="Изменить ключевые слова сайта"
      :setting-id="5"
      :value="settings.siteMK"
      placeholder="Введите ключевые слова"
    />
    <setting-item
      title="Изменить E-mail администратора"
      :setting-id="7"
      :value="settings.adminEmail"
      placeholder="Введите E-mail"
    />
    <setting-item
      title="Изменить количество элементов на странице"
      :setting-id="8"
      :value="settings.countOnPage"
      placeholder="Введите количество (цифры)"
    />
    <setting-item
      title="Изменить количество записей на странице"
      :setting-id="9"
      :value="settings.countPostsOnPage"
      placeholder="Введите количество (цифры)"
    />
  </div>
</template>

<script>
import { index } from '../../api/api'
const SettingItem = () => import('./components/SettingItem')
export default {
  name: 'SettingList',
  components: { SettingItem },
  data() {
    return {
      settings: {
        siteName: '',
        siteDesc: '',
        siteLogo: '',
        siteMD: '',
        siteMK: '',
        adminEmail: '',
        countOnPage: '',
        countPostsOnPage: ''
      }
    }
  },
  created() {
    this.getSettings()
  },
  methods: {
    getSettings() {
      index('settings').then((res) => {
        this.settings.siteName = res.data.siteName
        this.settings.siteDesc = res.data.siteDesc
        this.settings.siteLogo = res.data.siteLogo
        this.settings.siteMD = res.data.siteMD
        this.settings.siteMK = res.data.siteMK
        this.settings.adminEmail = res.data.adminEmail
        this.settings.countOnPage = res.data.countOnPage
        this.settings.countPostsOnPage = res.data.countPostsOnPage
      })
    }
  }
}
</script>

<style scoped>

</style>
