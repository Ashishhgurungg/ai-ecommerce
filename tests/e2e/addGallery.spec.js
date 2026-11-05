import { test, expect } from '@playwright/test';
import { LoginPage } from './pageObjects/LoginPage';
import { DashboardPage } from './pageObjects/DashboardPage';
import { AddNewGallery } from './pageObjects/AddNewGallery';
import { EMAIL, PASSWORD } from './utils/constants';

test("add new gallery", async ({ page }) => {
    const loginPage = new LoginPage(page);
    const dashboardPage = new DashboardPage(page);
    const addNewGalleryPage = new AddNewGallery(page);
    await loginPage.navigate();
    await loginPage.login(EMAIL, PASSWORD);
    await expect(page).toHaveURL(dashboardPage.url);
    await dashboardPage.navigateToAddNewGAlleryPage();
    await expect(page).toHaveURL(addNewGalleryPage.url);
});
