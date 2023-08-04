// match unique body_class
import Router from './util/Router'
import common from './routes/common'
import pageTemplateLegal from './routes/legal'
import single from './routes/single'
import frontPage from './routes/front-page' //SETUP
import history from './routes/history'
import singleProduct from './routes/single-product';
import itemizedRfq from './routes/itemized-rfq';

/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
  common,
  single,
  pageTemplateLegal,
  frontPage,
  history,
  singleProduct,
  itemizedRfq
})

/** Load Events */
routes.loadEvents()
