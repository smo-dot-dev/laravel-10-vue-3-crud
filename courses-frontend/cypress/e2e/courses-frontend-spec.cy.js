describe("courses-frontend spec", () => {
  beforeEach(() => {
    // Cypress starts out with a blank slate for each test
    // so we must tell it to visit our website with the `cy.visit()` command.
    // Since we want to visit the same URL at the start of all our tests,
    // we include it in our beforeEach function so that it runs before each test
    cy.visit("http://localhost:9000/#/");
  });

  it("displays Q-Table", () => {
    cy.get(".q-table").should("exist");
  });

  it("opens the create course modal when clicking 'Create a new course' button", () => {
    // Click the 'Create a new course' button
    cy.get('button:contains("Create a new course")').click();

    // Check that the modal is displayed
    cy.get(".q-dialog").should("be.visible");

    // Fill the form fields
    cy.get(".q-dialog").within(() => {
      cy.get('input[aria-label="Title"]').type("Test Course");
      cy.get('input[aria-label="Description"]').type("This is a test course");
      cy.get('input[aria-label="Video URL"]').type("http://test.com");
      cy.get('input[aria-label="Video Duration (seconds)"]').type("3600");
    });

    // Click the 'Save' button
    cy.get('button:contains("Save")').click();
  });
});
