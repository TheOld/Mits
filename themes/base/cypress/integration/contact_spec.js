describe('Contact Us page', function() {
	it('Load contact page', function() {
		cy.visit('https://mmnz-2.dev')

		cy.get('.navigation__item').contains('Contact Us').click()

		cy.title().should('include', 'Contact Us')
	})
})
