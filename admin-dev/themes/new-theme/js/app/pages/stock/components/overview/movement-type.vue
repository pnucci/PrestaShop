<!--**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 *-->
<template>
  <div class="col-md-4">
    <div class="movements">
      <PSButton
        type="button"
        class="update-qty float-sm-right"
        :class="classObject"
        :disabled="disabled"
        :primary="true"
        @click="sendQty"
      >
        <i class="material-icons">edit</i>
        {{ trans('button_movement_type') }}
      </PSButton>
    </div>
  </div>
</template>

<script lang="ts">
  import Vue from 'vue';
  import PSButton from '@app/widgets/ps-button.vue';

  export default Vue.extend({
    computed: {
      disabled(): boolean {
        return !this.$store.state.hasQty;
      },
      classObject(): Record<string, any> {
        return {
          'btn-primary': !this.disabled,
        };
      },
    },
    methods: {
      sendQty(): void {
        this.$store.state.hasQty = false;
        this.$store.dispatch('updateQtyByProductsId');
      },
    },
    components: {
      PSButton,
    },
  });
</script>

<style lang="scss" scoped>
  @import '~@scss/config/_settings.scss';

  .update-qty {
    color: white;
    transition: background-color 0.2s ease;
  }
</style>
