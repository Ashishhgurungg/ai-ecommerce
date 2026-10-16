import { test, expect } from "@playwright/test";
import { LoginPage } from "./pageObjects/LoginPage";
import { DashboardPage } from "./pageObjects/DashboardPage";

const email = "admin@mail.com";
const password = "Admin@123";

// test("navigate to login page", async ({ page }) => {
//     await page.goto("http://127.0.0.1:8000/");
//     await page.getByRole("link", { name: "Log in" }).click();
//     await expect(page.getByRole("img", { name: "My Logo" })).toBeVisible();
//     await expect(page).toHaveURL("http://127.0.0.1:8000/login");
// });

test("login with valid credentials", async ({ page }) => {
    const loginPage = new LoginPage(page);
    const dashboardPage = new DashboardPage(page);
    await loginPage.navigate();
    await loginPage.login(email, password);
    await expect(page).toHaveURL(dashboardPage.url);
});
