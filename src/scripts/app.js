import WooGallery from "./components/WooGallery";

const main = async (err) => {

    if (err) {
      console.error(err);
    }

    // WooGallery
    const _gallery = new WooGallery();
    _gallery.init();
    
};

main();