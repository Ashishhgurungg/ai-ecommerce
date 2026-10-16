import {test, expect} from '@playwright/test';

test ('navigate to login page', async ({page}) => {
    await page.goto('http://127.0.0.1:8000/');
    await page.getByRole('link', {name: 'Log in'}).click();
    await expect(page.getByRole('img', {name:'My Logo'})).toBeVisible();
});
