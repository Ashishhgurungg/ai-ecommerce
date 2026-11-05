import { BASE_URL } from "../utils/constants";

export class DashboardPage {
    constructor(page) {
        this.page = page;
        this.url = `${BASE_URL}/dashboard`;
        this.addNewBtn = this.page.getByRole('button', { name: 'New' });
        this.galleryLink = this.page.getByRole('link', { name: 'Gallery'});
    }

    async navigateToAddNewGAlleryPage() {
        await this.addNewBtn.click();
        await this.galleryLink.click();
    }
}
