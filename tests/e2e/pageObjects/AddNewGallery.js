import { BASE_URL } from "../utils/constants.js";

export class AddNewGallery {
    constructor(page) {
        this.page = page;
        this.url = `${BASE_URL}/gallery-form`;
        this.addGalleryHeading = this.page.getByRole('heading', { name: 'Add New Gallery'});
        this.galleryTitleField = this.page.getByRole('textbox', { name: 'Gallery Title'});
        this.galleryDescriptionField = this.page.getByRole('textbox', { name: 'GalleryDescription'});
        this.chooseImageBtn = this.page.getByRole('button', { name: 'Choose Image FIles'});
        this.addGalleryBtn = this.page.getByRole('button', { name: 'Add Gallery'});
    }

    async addNewGallery(galleryTitle, galleryDescription, imagePath) {
        await this.galleryTitleField.fill(galleryTitle);
        await this.galleryDescriptionField.fill(galleryDescription);
        await this.chooseImageBtn.setInputFiles(imagePath);
        await this.addGalleryBtn.click();
    }
}
