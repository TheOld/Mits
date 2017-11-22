import graphql from 'graphql-client';

export class GraphqlClient {
	static ERROR = {
		INTERNAL: 'Error communicating with the server.',
		AUTH: 'Authentication issue.'
	}

	init() {
		// instanciate the graphql client fetch object
		this.client = graphql({
			url: `${window.location.origin}/graphql`,
			headers: {
				Authorization: `Bearer ${window.graphAuthToken}`
			}
		});
	}

	query(query, variable = {}) {
		// make sure that client exist before calling it
		if (!this.client) this.init();
		// wrap the graphql client with our own method that will
		// catch if query fails (errors are thrown with message and query highlight)
		return this.client.query(query, variable, this.callback);
	}

	callback(req, res) {
		if (res.status === 500) {
			window.alert(GraphqlClient.ERROR.INTERNAL);
			throw new Error(GraphqlClient.ERROR.INTERNAL);
		}
	}
}

export const graphqlClient = new GraphqlClient();
