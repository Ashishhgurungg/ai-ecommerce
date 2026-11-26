import { test, expect } from "@playwright/test";
import { LoginPage } from "./pageObjects/LoginPage";
import { DashboardPage } from "./pageObjects/DashboardPage";
import { BASE_URL, EMAIL, PASSWORD } from "./utils/constants";

test("navigate to login page from home page", async ({ page }) => {
    await page.goto(`${BASE_URL}/`);
    await page.getByRole("link", { name: "Log in" }).click();
    await expect(page.getByRole("img", { name: "My Logo" })).toBeVisible();
    await expect(page).toHaveURL(`${BASE_URL}/login`);
});

test("login with valid credentials", async ({ page }) => {
    const loginPage = new LoginPage(page);
    const dashboardPage = new DashboardPage(page);
    await loginPage.navigate();
    await loginPage.login(EMAIL, PASSWORD);
    await expect(page).toHaveURL(dashboardPage.url);
});
